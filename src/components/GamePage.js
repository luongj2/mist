import { useParams } from "react-router-dom"

export default function GamePage() {
    let params = useParams();
    return (
        <h1>{`Game Page (ID: ${params.id})`}</h1>
    )
}