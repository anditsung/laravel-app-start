const pages = {
    "Web.Home": require('./Pages/Web/Home'),
    "Web.Error": require('./Pages/Web/Error'),
    "Web.UniversalGloves": require('./Pages/Web/UniversalGloves'),
    "Web.LatexindoTobaperkasa": require('./Pages/Web/LatexindoTobaperkasa'),

    // AUTH
    "Auth.Login": require('./Pages/Auth/Login'),
    "Auth.Register": require('./Pages/Auth/Register'),
    'Auth.ForgotPassword': require('@/pages/Auth/ForgotPassword'),
    'Auth.ResetPassword': require('@/pages/Auth/ResetPassword'),
    'Auth.TwoFactorChallenge': require('@/Pages/Auth/TwoFactorChallenge'),

    // SECURE
    "Dashboard": require('./Pages/Secure/Dashboard'),
    "Profile/Show": require('./Pages/Secure/Profile/Show'),
    "User": require('./Pages/Secure/User'),
    "Role": require('./Pages/Secure/Role'),
    "Permission": require('./Pages/Secure/Permission'),
    "Invite": require('./Pages/Secure/Invite'),
}

export default pages
