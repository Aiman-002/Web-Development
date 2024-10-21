

function checkPalindrome() {
    const inputString = document.getElementById('inputString').value;
    const resultElement = document.getElementById('result');

    const isPalindrome = isPalindromeString(inputString);

    if (isPalindrome) {
        resultElement.innerText = `"${inputString}" is a palindrome!`;
    } else {
        resultElement.innerText = `"${inputString}" is not a palindrome.`;
    }
}

function isPalindromeString(str) {
    const cleanedString = str.toLowerCase();
    const reversedString = reverseString(cleanedString);
    return cleanedString === reversedString;
}

function reverseString(str) {
    return str.split('').reverse().join('');
}
