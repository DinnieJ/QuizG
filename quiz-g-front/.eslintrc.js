module.exports = {
    root: true,
    env: {
        node: true
    },
    extends: ["plugin:vue/recommended", "eslint:recommended", "prettier/vue"],
    rules: {
        "vue/component-name-in-template-casing": ["error", "PascalCase"],
        "no-console": process.env.NODE_ENV === "production" ? "error" : "off",
        "no-debugger": process.env.NODE_ENV === "production" ? "error" : "off",
        "vue/require-default-prop": "off",
        "vue/require-prop-types": "off",
        "max-len": "off",
        "vue/no-side-effects-in-computed-properties": "off",
        "vue/html-closing-bracket-spacing": "error",
        "vue/html-closing-bracket-newline": [
        "error",
        {
            singleline: "never",
            multiline: "always"
        }
        ],
        "vue/no-v-html": "off",
        "no-case-declarations": "off",
        "array-element-newline": "off",
        "array-bracket-spacing": ["error", "never"],

        camelcase: [
        "error",
        {
            properties: "never"
        }
        ],

        "comma-dangle": ["error", "never"],

        "eol-last": ["error"],

        indent: [
        "error",
        2,
        {
            SwitchCase: 1
        }
        ],

        "keyword-spacing": ["error"],

        "no-else-return": ["error"],

        "no-mixed-spaces-and-tabs": ["error"],

        "no-multiple-empty-lines": ["error"],

        "no-spaced-func": ["error"],

        "no-trailing-spaces": ["error"],

        "no-undef": ["error"],

        "no-unexpected-multiline": ["error"],

        "no-unused-vars": [
        "error",
        {
            args: "none",
            vars: "all"
        }
        ],
        // 'semi': ['error', 'never'],

        "space-before-blocks": ["error", "always"],

        "space-in-parens": ["error", "never"],

        "space-unary-ops": [
        "error",
        {
            nonwords: false,
            overrides: {}
        }
        ],

        'arrow-body-style': ['error', 'as-needed', {
        'requireReturnForObjectLiteral': false
        }],

        'arrow-parens': ['error', 'as-needed'],

        'arrow-spacing': ['error', {
        'after': true,
        'before': true
        }],

        'no-class-assign': ['error'],

        "no-const-assign": ["error"],

        "no-dupe-class-members": ["error"],

        "no-duplicate-imports": ["error"],

        "no-new-symbol": ["error"],

        "no-useless-rename": ["error"],

        "no-var": ["error"],

        "prefer-arrow-callback": [
        "error",
        {
            allowNamedFunctions: false,
            allowUnboundThis: true
        }
        ],

        "prefer-rest-params": ["error"],

        "prefer-template": ["error"],

        "template-curly-spacing": ["error", "never"]
    },
    parserOptions: {
        parser: "babel-eslint",
        ecmaVersion: 6,
        sourceType: "module",
        ecmaFeatures: {
        impliedStrict: true,
        objectLiteralDuplicateProperties: false
        }
    }
};
  