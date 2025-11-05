/* snake.c — Snake console Windows (MSVC)
   - 3 pommes affichées en même temps
   - Grandit de +3 segments après avoir mangé ces 3 pommes d'une même séquence
*/

#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <conio.h>
#include <ctype.h>
#include <windows.h>

#define UP    72
#define DOWN  80
#define LEFT  75
#define RIGHT 77

/* --- Variables globales --- */
int length;           /* longueur du serpent (nb segments)              */
int bend_no;          /* index du dernier "coude" mémorisé              */
int len;              /* longueur dessinée sur le tick courant           */
char key;             /* dernière touche de direction                    */
int life;             /* nb de vies                                      */
int apples = 0;       /* COMPTEUR de pommes mangées (total)              */
int applesStreak = 0; /* COMPTEUR de pommes dans la séquence courante    */
int tickMs = 110;     /* durée d'une frame en ms (lissage de vitesse)    */

void record(void);
void load(void);
void Delay(long double);
void Move(void);
void Food(void);
int  Score(void);
void Print(void);
void gotoxy(int x, int y);
void GotoXY(int x, int y);
void Bend(void);
void Boarder(void);
void Down(void);
void Left(void);
void Up(void);
void Right(void);
void ExitGame(void);
int  Scoreonly(void);

struct coordinate {
    int x;
    int y;
    int direction;
};

typedef struct coordinate coordinate;

/* Tête, coudes, nourriture, corps
   -> foods[3] = 3 pommes simultanées
*/
coordinate head, bend[500], foods[3], body[200];

/* Petit helper pour générer une pomme dans la zone de jeu */
void SpawnApple(int idx)
{
    foods[idx].x = rand() % 70;
    if (foods[idx].x <= 10) foods[idx].x += 11;
    foods[idx].y = rand() % 30;
    if (foods[idx].y <= 10) foods[idx].y += 11;
}

int main(void)
{
    /* seed RNG une seule fois */
    srand((unsigned)time(NULL));

    Print();
    system("cls");
    load();

    length = 5;
    head.x = 25;
    head.y = 20;
    head.direction = RIGHT;

    life = 3;
    bend_no = 0;
    bend[0] = head;
    applesStreak = 0;

    /* initialise les pommes à 0 pour que Food() crée une première séquence */
    for (int i = 0; i < 3; i++) {
        foods[i].x = 0;
        foods[i].y = 0;
    }

    Boarder();
    Food();        /* génère la première séquence de 3 pommes */

    Move();        /* lance la boucle de jeu */
    return 0;
}

/* Déplace le curseur (compat Windows) */
void gotoxy(int x, int y)
{
    COORD coord; coord.X = (SHORT)x; coord.Y = (SHORT)y;
    SetConsoleCursorPosition(GetStdHandle(STD_OUTPUT_HANDLE), coord);
}
void GotoXY(int x, int y)
{
    HANDLE h = GetStdHandle(STD_OUTPUT_HANDLE);
    COORD  c; c.X = (SHORT)x; c.Y = (SHORT)y;
    fflush(stdout);
    SetConsoleCursorPosition(h, c);
}

/* Ecran d'attente ("loading") */
void load(void)
{
    int r, q;
    gotoxy(36, 14); printf("loading...");
    gotoxy(30, 15);
    for (r = 1; r <= 20; r++) {
        for (q = 0; q <= 10000000; q++) { ; } /* affichage lent de la barre */
        printf("%c", 177);
    }
    getch();
}

/* Mouvement global + lecture des touches (structure d'origine, récursive) */
void Move(void)
{
    int a, i;

    do {
        Food();   /* met à jour les pommes + croissance éventuelle */
        len = 0;

        for (i = 0; i < (int)(sizeof(body)/sizeof(body[0])); i++) {
            body[i].x = 0; body[i].y = 0;
            if (i == length) break; /* initialise seulement la partie utile */
        }

        Delay(length);   /* -> Sleep(tickMs) + Score() */
        Boarder();

        if      (head.direction == RIGHT) Right();
        else if (head.direction == LEFT)  Left();
        else if (head.direction == DOWN)  Down();
        else if (head.direction == UP)    Up();

        ExitGame();

    } while (!kbhit());  /* boucle tant qu'aucune touche n'est pressée */

    a = getch();
    if (a == 27) { system("cls"); exit(0); } /* ESC */

    key = getch();       /* flèche de direction */

    /* Evite demi-tour immédiat et répétition de direction */
    if ((key == RIGHT && head.direction != LEFT  && head.direction != RIGHT) ||
        (key == LEFT  && head.direction != RIGHT && head.direction != LEFT)  ||
        (key == UP    && head.direction != DOWN  && head.direction != UP)    ||
        (key == DOWN  && head.direction != UP    && head.direction != DOWN))
    {
        bend_no++;
        bend[bend_no] = head;          /* mémorise le "coude" */
        head.direction = key;

        /* avance d'une case dans la nouvelle direction */
        if (key == UP)    head.y--;
        if (key == DOWN)  head.y++;
        if (key == RIGHT) head.x++;
        if (key == LEFT)  head.x--;

        Move();
    }
    else if (key == 27) { system("cls"); exit(0); } /* ESC */
    else { printf("\a"); Move(); }                  /* bip si invalide */
}

/* Mouvement vers le bas */
void Down(void)
{
    int i;
    for (i = 0; i <= (head.y - bend[bend_no].y) && len < length; i++) {
        GotoXY(head.x, head.y - i);
        if (len == 0) printf("v"); else printf("*");
        body[len].x = head.x; body[len].y = head.y - i; len++;
    }
    Bend();
    if (!kbhit()) head.y++;
}

/* LISSAGE: pause réelle + affichage score/vies */
void Delay(long double k)
{
    (void)k;          /* param non utilisé, gardé pour compat */
    Sleep(tickMs);    /* lissage propre */
    Score();          /* met à jour l'affichage score/vies/apples */
}

/* Collisions (mur / corps) + gestion des vies */
void ExitGame(void)
{
    int i, check = 0;
    for (i = 4; i < length; i++) { /* commence à 4 pour éviter faux positifs */
        if (body[0].x == body[i].x && body[0].y == body[i].y) { check++; }
        if (i == length || check != 0) break;
    }

    /* Murs mortels (cadre ! de (10,10) à (70,30)) ou auto-collision */
    if (head.x <= 10 || head.x >= 70 || head.y <= 10 || head.y >= 30 || check != 0) {
        life--;
        if (life >= 0) {
            /* RESET COMPLET DE LA SÉQUENCE */
            length = 5;          /* <-- RESET LONGUEUR ICI */
            head.x = 25;
            head.y = 20;
            bend_no = 0;
            head.direction = RIGHT;

            applesStreak = 0;    /* on reset la séquence de pommes */

            /* on force la régénération de 3 nouvelles pommes */
            for (i = 0; i < 3; i++) {
                foods[i].x = 0;
                foods[i].y = 0;
            }

            Move();
        } else {
            system("cls");
            printf("All lives completed\nBetter Luck Next Time!!!\nPress any key to quit the game\n");
            record();
            exit(0);
        }
    }
}

/* Nourriture + croissance
   - 3 pommes AFFICHÉES en même temps
   - quand les 3 sont mangées -> +3 segments d'un coup, nouvelle séquence de 3
*/
void Food(void)
{
    int i;
    int active = 0;

    /* Compte combien de pommes de la séquence sont encore présentes */
    for (i = 0; i < 3; i++) {
        if (foods[i].x != 0) active++;
    }

    /* Si aucune pomme active (début ou après fin de séquence) -> créer 3 nouvelles */
    if (active == 0) {
        for (i = 0; i < 3; i++) {
            SpawnApple(i);
        }
        return;
    }

    /* Vérifie si la tête mange une des pommes actuelles */
    for (i = 0; i < 3; i++) {
        if (foods[i].x != 0 &&
            head.x == foods[i].x &&
            head.y == foods[i].y) {

            apples++;          /* total (pour affichage)   */
            applesStreak++;    /* dans la séquence courante */

            /* "Supprime" cette pomme de l'écran */
            foods[i].x = 0;
            foods[i].y = 0;
            active--;
        }
    }

    /* Si on a mangé les 3 pommes de la séquence */
    if (applesStreak == 3) {
        int k;
        for (k = 0; k < 3 && length < (int)(sizeof(body)/sizeof(body[0])) - 1; k++) {
            length++;  /* +3 segments d'un coup (ou moins si limite) */
        }

        applesStreak = 0;   /* nouvelle séquence à venir */

        /* petite accélération à chaque "grosse" croissance (optionnel) */
        if (tickMs > 60) tickMs -= 5;

        /* toutes les pommes ont normalement été mangées à ce moment,
           donc on laissera SpawnApple recréer une nouvelle séquence
           au prochain appel de Food() */
    }

    /* Si plus aucune pomme active et que la séquence est finie (applesStreak == 0)
       -> on génère une nouvelle séquence de 3 pommes */
    active = 0;
    for (i = 0; i < 3; i++) {
        if (foods[i].x != 0) active++;
    }
    if (active == 0 && applesStreak == 0) {
        for (i = 0; i < 3; i++) {
            SpawnApple(i);
        }
    }
}

/* Mouvement vers la gauche */
void Left(void)
{
    int i;
    for (i = 0; i <= (bend[bend_no].x - head.x) && len < length; i++) {
        GotoXY((head.x + i), head.y);
        if (len == 0) printf("<"); else printf("*");
        body[len].x = head.x + i; body[len].y = head.y; len++;
    }
    Bend();
    if (!kbhit()) head.x--;
}

/* Mouvement vers la droite */
void Right(void)
{
    int i;
    for (i = 0; i <= (head.x - bend[bend_no].x) && len < length; i++) {
        body[len].x = head.x - i; body[len].y = head.y;
        GotoXY(body[len].x, body[len].y);
        if (len == 0) printf(">"); else printf("*");
        len++;
    }
    Bend();
    if (!kbhit()) head.x++;
}

/* Dessine les segments le long des coudes mémorisés */
void Bend(void)
{
    int i, j, diff;
    for (i = bend_no; i >= 0 && len < length; i--) {
        if (i == 0) break; /* évite l'accès à bend[-1] */
        if (bend[i].x == bend[i - 1].x) {
            diff = bend[i].y - bend[i - 1].y;
            if (diff < 0) {
                for (j = 1; j <= (-diff); j++) {
                    body[len].x = bend[i].x; body[len].y = bend[i].y + j;
                    GotoXY(body[len].x, body[len].y); printf("*");
                    if (++len == length) break;
                }
            } else if (diff > 0) {
                for (j = 1; j <= diff; j++) {
                    body[len].x = bend[i].x; body[len].y = bend[i].y - j;
                    GotoXY(body[len].x, body[len].y); printf("*");
                    if (++len == length) break;
                }
            }
        } else if (bend[i].y == bend[i - 1].y) {
            diff = bend[i].x - bend[i - 1].x;
            if (diff < 0) {
                for (j = 1; j <= (-diff) && len < length; j++) {
                    body[len].x = bend[i].x + j; body[len].y = bend[i].y;
                    GotoXY(body[len].x, body[len].y); printf("*");
                    if (++len == length) break;
                }
            } else if (diff > 0) {
                for (j = 1; j <= diff && len < length; j++) {
                    body[len].x = bend[i].x - j; body[len].y = bend[i].y;
                    GotoXY(body[len].x, body[len].y); printf("*");
                    if (++len == length) break;
                }
            }
        }
    }
}

/* Bordure + les 3 pommes */
void Boarder(void)
{
    system("cls");
    int i;

    /* Affiche les 3 pommes actives */
    for (i = 0; i < 3; i++) {
        if (foods[i].x != 0) {
            GotoXY(foods[i].x, foods[i].y);
            printf("F");
        }
    }

    /* Murs */
    for (i = 10; i < 71; i++) { GotoXY(i, 10); printf("!"); GotoXY(i, 30); printf("!"); }
    for (i = 10; i < 31; i++) { GotoXY(10, i); printf("!");  GotoXY(70, i); printf("!"); }
}

/* Ecran d'accueil + règles */
void Print(void)
{
    printf("\tWelcome to the Snake game\n");
    getch();
    system("cls");
    printf("\t\tGame instructions\n");
    printf("\n1. Use arrow keys to move the snake."
           "\n\n2. Press any key to pause the game. To continue press any other key once again"
           "\n\n3. Press ESC to exit\n");
    printf("\n\nPress any key...");
    if (getch() == 27) exit(0);
}

/* Sauvegarde le score + affiche l'historique si demandé */
void record(void)
{
    char plname[20], nplname[20], cha, c;
    int i, j, px;
    FILE *info = fopen("record.txt", "a+");
    getch();
    system("cls");
    printf("Enter your name\n");
    scanf("%19[^\n]", plname);

    /* met en majuscule l'initiale et après un espace */
    for (j = 0; plname[j] != '\0'; j++) {
        nplname[0] = (char)toupper(plname[0]);
        if (j > 0 && plname[j - 1] == ' ') {
            nplname[j] = (char)toupper(plname[j]);
            nplname[j - 1] = plname[j - 1];
        } else {
            nplname[j] = plname[j];
        }
    }
    nplname[j] = '\0';

    fprintf(info, "Player Name : %s\n", nplname);

    time_t mytime = time(NULL);
    fprintf(info, "Played Date: %s", ctime(&mytime));

    fprintf(info, "Score: %d\n", px = Scoreonly());
    for (i = 0; i <= 50; i++) fprintf(info, "%c", '_');
    fprintf(info, "\n");
    fclose(info);

    printf("wanna see past records? press 'y'\n");
    cha = getch();
    system("cls");
    if (cha == 'y') {
        info = fopen("record.txt", "r");
        if (info) {
            do { c = (char)getc(info); if (c == EOF) break; putchar(c); } while (1);
            fclose(info);
        }
    }
}

/* Affiche score + vies + pommes */
int Score(void)
{
    int score = length - 5;
    GotoXY(20, 8); printf("SCORE : %d", score);
    GotoXY(50, 8); printf("Life : %d", life);
    GotoXY(60, 8); printf("Apples: %d", apples);
    return score;
}
int Scoreonly(void)
{
    int score = Score();
    system("cls");
    return score;
}

/* Mouvement vers le haut */
void Up(void)
{
    int i;
    for (i = 0; i <= (bend[bend_no].y - head.y) && len < length; i++) {
        GotoXY(head.x, head.y + i);
        if (len == 0) printf("^"); else printf("*");
        body[len].x = head.x; body[len].y = head.y + i; len++;
    }
    Bend();
    if (!kbhit()) head.y--;
}