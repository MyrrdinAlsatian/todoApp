module.exports = {
    // prettier-ignore
    types: [{
            value: '[✨ feat]',
            name: '✨   Features: Ajout/mise à jour de fonctionnalité',
        }, {
            value: '[🎉 New]',
            name: '🎉   Nouveau projet',
        },
        {
            value: '[🚧 WIP]',
            name: '🚧   Work-in-progress: en cour de développement',
        },
        {
            value: '[🐛 fix]',
            name: '🐛   Correction de bug',
        },
        {
            value: '[🔖 release]',
            name: '🔖   Release/Nouvelle version',
        },
        {
            value: '[🚑️ critical fix]',
            name: '🚑️   Fix urgent',
        },
        {
            value: '[📝 docs]',
            name: '📝   Ajout/modif. de la documentation',
        },
        {
            value: '[🎨 styles]',
            name: '🎨   Modifs de style et de mise en forme du code (espacements, virgules, etc.)',
        },
        {
            value: '[♻️ refactor]',
            name: '♻️   Modif. des sources n’étant ni un correctif, ni un ajout de fonctionnalité',
        },
        {
            value: '[🚀 perf]',
            name: '🚀   Amélioration de la performance',
        },
        {
            value: '[🧪 test]',
            name: '🧪   Ajout ou correction de tests',
        },
        {
            value: '[👷 build]',
            name: '👷   Modif. affectant le "build" ou les dépendances externes (exemples de contextes :  webpack, broccoli, npm)',
        },
        {
            value: '[🏗️ archi]',
            name: "🏗️   Modif. affectant l'architecture du projet ( renommage et/ou déplacement de fichier, dossier, ...)",
        },
        {
            value: '[⚙️ ci]',
            name: '⚙️   Modif. de la configuration ou des scripts liés à la CI (Gitlab, AWS, ...)',
        },
        {
            value: '[💚 chores]',
            name: '💚   Autres mises à jour ne modifiant ni les sources, ni les tests',
        },
        {
            value: '[🔀 merge]',
            name: '🔀   Merge de branche',
        },
        {
            value: '[🍱 assets]',
            name: '🍱   Ajout et modification des assets',
        },
        {
            value: '[⏪️ revert]',
            name: '⏪️    Annuler (revert) un commit précédent',
        },
        {
            value: '[🗑 clean]',
            name: '🗑   Suppression de code non-utilisé',
        },
    ],
    scopes: [
        {
            name: '*',
        },
        {
            name: 'Front',
        },
        {
            name: 'Back',
        },
        {
            name: 'config',
        },
    ],

    allowTicketNumber: false,
    isTicketNumberRequired: false,
    ticketNumberPrefix: 'TICKET-',
    ticketNumberRegExp: '\\d{1,5}',

    // it needs to match the value for field type. Eg.: 'fix'
    /*
    scopeOverrides: {
      fix: [
        {name: 'merge'},
        {name: 'style'},
        {name: 'e2eTest'},
        {name: 'unitTest'}
      ]
    },
    */
    // override the messages, defaults are as follows
    messages: {
        type: 'Choisissez le type de modification que concerne votre commit :',
        scope: 'Quel est le contexte des modifications (global, nom de fichier, ou vide)',
        // used if allowCustomScopes is true
        customScope:
            'Quel est le contexte des modifications (composant, nom de fichier, fonctionnalité)',
        subject: 'Écrivez une description concise, à l’impératif\n',
        body: 'Renseignez une description plus détaillée des modifications (facultatif). Utiliser "|" pour passer à la ligne:\n',
        breaking:
            'Ce commit risque t\'il de casser la compatibilité ascendante ("breaking changes")? \n Si oui, veuillez renseigner une description plus longue et détaillée que la première ligne du commit.\n',
        footer: 'Cela concerne-t-il un ticket existant ? (facultatif) \n Ajoutez une référence de ticket ("fix #123", "ref #123")\n',
        confirmCommit: 'Êtes vous sur de vouloir commit ce message ? \n',
    },

    allowCustomScopes: true,
    allowBreakingChanges: [
        '[✨ feat]',
        '[🚑️ critical fix]',
        '[👷 build]',
        '[🏗️ archi]',
        '[⚙️ ci]',
        '[🔀 merge]',
        '[⏪️ revert]',
    ],
    // skip any questions you want
    // skipQuestions: ['body', 'breaking', 'footer'],

    // limit subject length
    subjectLimit: 100,
    // breaklineChar: '|', // It is supported for fields body and footer.
    footerPrefix: 'ISSUES CLOSED:',
    breakingPrefix: 'BREAKING CHANGE:',
    askForBreakingChangeFirst: false, // default is false
};
