const options = {
    printWidth: 100,
    tabWidth: 2,
    semi: true,
    singleQuote: true,
    trailingComma: 'all',
    bracketSpacing: true,
    endOfLine: 'crlf',
    arrowParens: 'avoid',
    overrides: [
        {
            files: '*.{js,jsx,tsx,ts,scss,json,html}',
            options: {
                tabWidth: 4,
            },
        },
    ],
};

module.exports = options;
