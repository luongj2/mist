import styles from "./Signup.module.scss";

export default function Signup() {
    return (
        <div className={styles.signup}>
            <div className={styles.title}>
                Sign Up
            </div>

            <form> 
                <div className={styles.form}>
                    <input type="text" name="userFirstName" placeholder="First Name" required="required" />
                    <input type="text" name="userLastName" placeholder="Last Name" required="required" />
                    <input type="email" name="userEmail" placeholder="Email" required="required" />
                    <input type="email" name="userEmailVerify" placeholder="Verify Email" required="required" />
                    <input type="password" name="userPassword" placeholder="Password" required="required" />
                    <input type="password" name="userPasswordVerify" placeholder="Verify Password" required="required" />
                </div>

                <div className={styles.submit}>
                    <button>Sign Up</button>
                </div>
            </form>
        </div>
    )
}