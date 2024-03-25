export const textInColor = (str) => {
    function convertToHex(str) {
        let hex = '';
        for (let i = 0; i < str.length; i++) {
            hex += str.charCodeAt(i).toString(16);
        }

        // Garder les 6 derniers caractères
        const lastSixChars = hex.slice(-6);
        return lastSixChars;
    }
    return convertToHex;
}
