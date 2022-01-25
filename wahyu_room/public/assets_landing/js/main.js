class Form {
  constructor(formButton, closeIcon, modal, body, contactForm) {
    this.formButton = formButton;
    this.closeIcon = closeIcon;
    this.modal = modal;
    this.body = body;
    this.contactForm = contactForm;
    this.openForm();
    this.closeForm();
    // this.submitForm();
  }

  openForm() {
    this.formButton.addEventListener("click", () => {
      this.modal.classList.add("display");
      this.body.classList.add("hide");
    });
  }

  closeForm() {
    this.closeIcon.addEventListener("click", () => {
      this.modal.classList.remove("display");
      this.body.classList.remove("hide");
    });
  }

  submitForm() {
    this.contactForm.addEventListener("submit", async (e) => {
      e.preventDefault();
      const data = {
        email: document.querySelector("#email").value,
        password: document.querySelector("#password").value,
      };

      try {
        const response = await axios.post(
          "https://tripadvisor-clone-api.herokuapp.com/form",
          data
        );
        console.log(response.data);
        if (response.status === 200) {
          alert("An email has been sent !");
        } else {
          alert("Bad request");
        }
      } catch (error) {
        console.error(error.message);
      }
    });
  }
}

const form = new Form(
  document.querySelector("#openForm"),
  document.querySelector("#closeForm"),
  document.querySelector("#modal"),
  document.querySelector(".body"),
  document.querySelector(".contact-form")
);


// NEWOOO
const $ = document;
$.addEventListener("DOMContentLoaded", () => {
    console.log("document loaded");
    let token = "";

    // open and close signup
    $.querySelector(".mobile").addEventListener("click", () => {
        $.querySelector(".burger").classList.toggle("visible");
    });

    // open and close signup
    $.querySelector(".loginBurger").addEventListener("click", () => {
        if (
            $.querySelector(".loginButton").innerHTML === "Connectez-vous" ||
            $.querySelector(".loginBurger").innerHTML === "Connectez-vous"
        ) {
            $.querySelector(".login").classList.add("visible");
        } else {
            token = "";
            $.querySelector(".loginButton").innerHTML = "Connectez-vous";
            $.querySelector(".loginBurger").innerHTML = "Connectez-vous";
        }
    });
    $.querySelector(".loginButton").addEventListener("click", () => {
        if ($.querySelector(".loginButton").innerHTML === "Connectez-vous") {
            $.querySelector(".login").classList.add("visible");
        } else {
            token = "";
            $.querySelector(".loginButton").innerHTML = "Connectez-vous";
            $.querySelector(".loginBurger").innerHTML = "Connectez-vous";
        }
    });
    $.querySelector(".login div span").addEventListener("click", () => {
        $.querySelector(".login").classList.remove("visible");
    });


    // route favorite
    // $.querySelector("#favorite").addEventListener("click", async (e) => {
    //     e.preventDefault();
    //     const data = {
    //         email: $.querySelector("#loginEmail").value,
    //         password: $.querySelector("#loginPassword").value,
    //         token: token,
    //     };
    //     console.log(data);
    //     const response = await axios.post("http://localhost:3000/login", data);
    //     console.log(response);
    //     token = response.data.token;
    // });
});
