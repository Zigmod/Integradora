
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", form.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    // Manejar la respuesta del servidor si es necesario
                }
            };
            xhr.send(formData);
        });