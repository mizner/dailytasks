(function ($) {

    function updateData(data, element) {
        $.ajax({
            url: TASKLIST.ajaxurl,
            type: "POST",
            dataType: "json",
            // async: false,
            // crossDomain: true,
            data: {
                "action": "dailytask_ajax_handler",
                "data": data,
                "user": TASKLIST.user_id,
                "security": TASKLIST.security
            },
            beforeSend: function () {
                console.log("before")
            },
            success: function (response) {
                // newNode(createPostContainer, "P", "Success");
                console.log("Response" + response);
                console.log(TASKLIST.success);
                element.classList.remove("modified");

                // Append with new ID
                var forms = document.querySelectorAll('[data-id]');

                for (let i = 0, max = forms.length; i < max; i++) {
                    let value = forms[i].getAttribute('data-id');
                    console.log(value);
                    if (value === '') {
                        let form = forms[i];
                        form.setAttribute('data-id', response);
                    }
                }


            },
            error: function (request, status, error) {
                // newNode(createPostContainer, "P", "Error");
                console.log("Status" + status);
                console.log("Error" + TASKLIST.error);
                console.log("Response Text" + request.responseText);
            }
        })
    }

    function collectData(data) {

        return {
            id: data.getAttribute('data-id'),
            checkbox: data.querySelector("[type='checkbox']").checked,
            text: data.querySelector("[type='text']").value,
            key: data.getAttribute('data-meta'),
        };
    }

    function taskListCore(tasks) {
        for (let i = 0, max = tasks.length; i < max; i++) {

            let checkbox = tasks[i].querySelector("[type='checkbox']");
            let text = tasks[i].querySelector("[type='text']");

            checkbox.addEventListener("change", function (e) {
                // console.log(this.checked);
                updateData(collectData(tasks[i]), tasks[i])
            });

            text.addEventListener("keyup", function (e) {
                this.parentElement.classList.add("modified");
            });

            // text.addEventListener("change", function (e) {
            //     // console.log(this.value)
            //     updateData(collectData(tasks[i]), tasks[i]);
            // });

            tasks[i].addEventListener("submit", function (e) {
                e.preventDefault();
                updateData(collectData(tasks[i]), tasks[i])
            })
        }
    }

    taskListCore(document.querySelectorAll("form.task-item"))

})(jQuery);