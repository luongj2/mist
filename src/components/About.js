import styles from "./About.module.scss";

export default function About() {
    return (
        <div className={styles.about}>
            <div className={styles.title}>
                About Us
            </div>

            <div className={styles.description}>
                <br />We serve to allow users to search and browse a variety of games in our game library through a web browser.<br />
                <br />Users can chat and create discussions through our online community forums.<br />
                <br />Publishers can also publish their own games alongside our expanding library.<br />
            </div>

            <div className={styles.members}>
                <br /><b>Joey Luong</b> - <i>Project Manager & Full-Stack Programmer</i><br /> 
                <br /><b>Harrison Baker</b> - <i>Technical Manager & Front-End Programmer</i><br />
                <br /><b>Huy Nguyen</b> - <i>Front-End Programmer</i><br />
                <br /><b>Jon Kraft</b> - <i>Back-End Programmer</i><br />
                <br /><b>Eric Liao</b> - <i>Back-End Programmer</i><br /> 
            </div>

            <div className={styles.picture}>
                
            </div>
        </div>
    )
}