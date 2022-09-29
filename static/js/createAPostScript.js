console.log("Script Loaded");

const form = document.forms['createAPostForm'];
const errorMessage = document.getElementById("errorMessage");

if (form)
{
    form.addEventListener('submit', validateForm);
}

function validateForm(event) 
{
   
    event.preventDefault();

    console.log(form.tileOfPostField.value);

    if(form.tileOfPostField.value === "")
    {
        errorMessage.innerText = "Please enter a title of the post";
    }

    else 
    {
        if(form.tileOfPostField.value.length > 70)
        {
            errorMessage.innerText = "Please enter a title of less of 70 characters or less";
        }
        
        else
        {
            if(form.tagsField.value === "")
            {
                errorMessage.innerText = "Please enter at least 1 tag";
            }

            else
            {
                if(form.contentField.value === "")
                {
                    errorMessage.innerText = "Please enter content";
                }

                else
                {
                    form.submit();
                }
            }
        }
    }
}
