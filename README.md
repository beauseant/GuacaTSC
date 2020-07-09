# GuacaTSC
Gestión de usuarios de guacamole filtrando a través de un LDAP

Aplicación web para autenticar los usuarios de un LDAP y permitirles, una vez autenticados, crear una cuenta en un Guacamole.

Guacamole permite la autenticación usando un LDAP, pero se deben añadir algunas entradas a la estrucutura. Ergo, necesitas acceso de administración a dicho LDAP.

Esta aplicación es útil cuando no se tiene acceso como administrador al LDAP, permite filtrar los usuarios del LDAP y darse de alta en el Guacamole.


Si se quiere usar el Docker:
podman build -t myphp .

Si se quiere modificar el código del docker:
sudo podman run -it -v /home/breakthoven/Mis_Documentos/Empresa_Trabajillos/GuacaTSC/web:/var/www/html -p 80:80 myphp

