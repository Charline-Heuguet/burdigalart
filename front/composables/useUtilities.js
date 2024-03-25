// On va exporter la fonction toTitleCase pour pouvoir l'utiliser dans d'autres composants
//Fonction pour mettre la premiere lettre en majuscule

export const useUtilities = () => {

    function toTitleCase(str) {
        return str.replace(
            /\w\S*/g,
            function (txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            }
        );
    }
    return { 
        toTitleCase, 
    }
}