module.exports = {
    extends: ['@commitlint/config-conventional'],
    rules: {
        'type-enum': [
            2,
            'always',
            [
                '[✨ feat]',
                '[🚧 WIP]',
                '[🐛 fix]',
                '[🔖 release]',
                '[🚑️ critical fix]',
                '[📝 docs]',
                '[🎨 styles]',
                '[♻️ refactor]',
                '[🚀 perf]',
                '[🧪 test]',
                '[👷 build]',
                '[🏗️ archi]',
                '[⚙️ ci]',
                '[💚 chores]',
                '[🔀 merge]',
                '[🍱 assets]',
                '[⏪️ revert]',
                '[🗑 clean]',
            ],
        ],
    },
};

