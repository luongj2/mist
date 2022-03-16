import styles from "./Login.module.scss"

export default function Login() {
    return (
        <div className={styles.login}>
            <div className={styles.title}>
                Log In
            </div>

            <form> 
                <div className={styles.form}>
                    <input type="email" name="userEmail" placeholder="Email" required="required" />
                    <input type="password" name="userPassword" placeholder="Password" required="required" />
                </div>

                <div className={styles.submit}>
                    <button>Log In</button>
                </div>
            </form>
        </div>
    )
}