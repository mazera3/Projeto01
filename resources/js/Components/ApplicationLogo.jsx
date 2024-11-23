export default function ApplicationLogo(props) {
    return (
        <svg 
        {...props}
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" width="400" height="400">
            <rect x="80" y="100" width="240" height="160" fill="green" rx="20" ry="20" />
            <rect x="100" y="120" width="200" height="120" fill="white" rx="16" ry="16" />
            <rect x="140" y="270" width="120" height="20" fill="red" rx="10" ry="10" />
            <rect x="180" y="290" width="40" height="20" fill="red" />
        </svg>
    );
}
