import { usePage } from "@inertiajs/vue3";

const Translations = {
    install(app) {
        // Helper function to access nested properties by string
        const getNestedTranslation = (obj, key) => {
            return key.split(".").reduce((o, i) => (o ? o[i] : null), obj);
        };

        app.config.globalProperties.__ = (key, replace = {}) => {
            const pageProps = usePage().props;

            // Use helper function to handle nested translation keys
            let translation =
                getNestedTranslation(pageProps.language, key) || key;

            Object.keys(replace).forEach((replaceKey) => {
                translation = translation.replace(
                    ":" + replaceKey,
                    replace[replaceKey],
                );
            });

            return translation;
        };

        app.config.globalProperties.__n = (key, number, replace = {}) => {
            const options = key.split("|");

            key = options[1];
            if (number === 1) {
                key = options[0];
            }

            return app.config.globalProperties.__(key, replace);
        };
    },
};

export default Translations;
