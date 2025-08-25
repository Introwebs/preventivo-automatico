export function getFormattedDate (date) {
    const inputDate = new Date(date);
    const day = inputDate.getDate();
    const month = inputDate.getMonth() + 1;
    const year = inputDate.getFullYear();
    const formattedDate = `${day < 10 ? '0' : ''}${day}/${month < 10 ? '0' : ''}${month}/${year}`;
    return formattedDate
}

export function getFormattedDateTime(date) {
    const inputDate = new Date(date);
    const day = inputDate.getDate();
    const month = inputDate.getMonth() + 1;
    const year = inputDate.getFullYear();

    const hours = inputDate.getHours();
    const minutes = inputDate.getMinutes();
    const seconds = inputDate.getSeconds();

    const formattedDate = `${day < 10 ? '0' : ''}${day}/${month < 10 ? '0' : ''}${month}/${year}`;
    const formattedTime = `${hours < 10 ? '0' : ''}${hours}:${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

    return `${formattedDate} ${formattedTime}`;
}

export function formatCurrency(value) {
    return value.toLocaleString('it-IT', { style: 'currency', currency: 'EUR' });
}

export function clearNameForUrl(inputString, separator = '|') {
    if (!inputString || typeof inputString !== 'string') {
        return '';
    }

    const baseString = inputString.includes(separator)
        ? inputString.split(separator)[0]
        : inputString;

    const cleared = baseString.trim().toLowerCase();
    return cleared.replace(/ /g, '-');
}
