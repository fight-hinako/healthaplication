function showError(error) {
    document.getElementById("login_error").textContent = error;
}

try {
    throw new Error("loginまたはPasswordが間違っています。もう一度入力してください");
} catch (error) {
    showError("エラー:" + error.message);
}


