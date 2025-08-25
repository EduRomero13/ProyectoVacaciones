# 🚀 Guía Completa de Servidores - Conceptos Técnicos y Referencia

## 🎯 ¿Qué es un Servidor?

Un **servidor** es una **aplicación de software** que ejecuta servicios para otros programas llamados **clientes**. Puede correr en hardware dedicado o compartido, pero lo crucial es el **stack de software** que maneja:

Cliente ←→ Protocolo ←→ Red ←→ Puerto ←→ Proceso Servidor

### 🔧 Anatomía Técnica de un Servidor

**1. Socket Binding (Enlace de Socket)**

-   El servidor se "enlaza" a una IP específica y puerto
-   Escucha conexiones entrantes (listening state)
-   Maneja múltiples conexiones concurrentes

**2. Protocolo de Comunicación**

-   **Capa de Aplicación:** HTTP, SMTP, FTP, etc.
-   **Capa de Transporte:** TCP (confiable) o UDP (rápido)
-   **Formato de Mensaje:** headers, body, encoding

**3. Manejo de Sesiones**

-   **Stateless:** cada request es independiente (HTTP)
-   **Stateful:** mantiene estado de conexión (FTP, SMTP)
-   **Persistent:** conexiones de larga duración (WebSockets)

---

## 🌐 Tipos de Servidores por Arquitectura

### **Servidor Web (HTTP Server)**

Navegador → DNS → IP:443 → TLS Handshake → HTTP Request → Respuesta

-   **Software común:** Apache, Nginx, IIS, Caddy
-   **Funciones:** servir páginas, APIs REST, balanceo de carga
-   **Optimizaciones:** compresión gzip, caching, CDN

### **Servidor de Base de Datos (Database Server)**

App → Connection Pool → Query Engine → Storage Engine → Disco

-   **RDBMS:** MySQL, PostgreSQL, SQL Server, Oracle
-   **NoSQL:** MongoDB, Redis, Cassandra, Elasticsearch
-   **Funciones:** ACID transactions, indexing, replication

### **Servidor de Aplicaciones (Application Server)**

Cliente → Load Balancer → App Server → Business Logic → Database

-   **Ejemplos:** Tomcat, JBoss, Node.js, Django
-   **Funciones:** procesamiento de lógica de negocio, APIs

---

## 🔌 Puertos y Protocolos Críticos

### **Web y APIs**

| Puerto    | Protocolo | Uso                | Seguridad        |
| --------- | --------- | ------------------ | ---------------- |
| 80        | HTTP      | Web tradicional    | ❌ Sin cifrado   |
| 443       | HTTPS     | Web seguro         | ✅ TLS/SSL       |
| 8080      | HTTP-Alt  | Desarrollo/Proxy   | ⚠️ Configuración |
| 3000-8000 | Custom    | APIs de desarrollo | ⚠️ Temporal      |

### **Bases de Datos**

| Puerto | Database      | Características             |
| ------ | ------------- | --------------------------- |
| 3306   | MySQL/MariaDB | RDBMS popular, replicación  |
| 5432   | PostgreSQL    | RDBMS avanzado, JSON nativo |
| 27017  | MongoDB       | NoSQL, documentos           |
| 6379   | Redis         | Cache en memoria, pub/sub   |
| 9200   | Elasticsearch | Búsqueda y analítica        |

### **Comunicación y Transferencia**

| Puerto | Servicio          | Protocolo | Seguridad            |
| ------ | ----------------- | --------- | -------------------- |
| 22     | SSH               | TCP       | ✅ Cifrado completo  |
| 21     | FTP               | TCP       | ❌ Texto plano       |
| 990    | FTPS              | TCP       | ✅ TLS               |
| 25     | SMTP              | TCP       | ⚠️ STARTTLS opcional |
| 587    | SMTP (Submission) | TCP       | ✅ TLS requerido     |
| 143    | IMAP              | TCP       | ⚠️ Opcional TLS      |
| 993    | IMAPS             | TCP       | ✅ TLS               |

---

## 🏗️ Arquitecturas de Servidor Modernas

### **1. Monolítico**

Cliente → Load Balancer → Single App → Database

-   **Pros:** Simple de desarrollar y deployar
-   **Contras:** Escalabilidad limitada, single point of failure

### **2. Microservicios**

Cliente → API Gateway → [Service A, Service B, Service C] → Databases

-   **Pros:** Escalabilidad independiente, tecnologías mixtas
-   **Contras:** Complejidad de red, latencia entre servicios

### **3. Serverless**

Cliente → CDN → Lambda/Cloud Functions → Managed Services

-   **Pros:** Auto-scaling, pago por uso
-   **Contras:** Cold starts, vendor lock-in

---

## ⚡ Conceptos de Rendimiento

### **Concurrencia y Paralelismo**

-   **Thread-based:** Un hilo por conexión (Apache tradicional)
-   **Event-driven:** Loop de eventos único (Node.js, Nginx)
-   **Worker processes:** Pool de procesos (Gunicorn, uWSGI)

### **Caching Strategies**

1. **Browser Cache:** headers HTTP (Cache-Control, ETag)
2. **Reverse Proxy:** Nginx, Varnish
3. **Application Cache:** Redis, Memcached
4. **Database Cache:** Query caching, buffer pools

### **Métricas Clave**

-   **Throughput:** requests/segundo
-   **Latency:** tiempo de respuesta
-   **CPU/Memory utilization:** recursos del sistema
-   **Connection pooling:** reutilización de conexiones DB

---

## 🛡️ Seguridad en Servidores

### **Hardening Básico**

-   Cambiar puertos por defecto
-   Firewall (iptables, AWS Security Groups)
-   Fail2ban para ataques de fuerza bruta
-   Actualizaciones de seguridad automáticas

### **Cifrado y Certificados**

-   **TLS 1.3:** protocolo más seguro actual
-   **Let's Encrypt:** certificados SSL gratuitos
-   **HSTS:** forzar HTTPS en navegadores
-   **Certificate pinning:** prevenir man-in-the-middle

### **Autenticación y Autorización**

-   **JWT Tokens:** stateless authentication
-   **OAuth 2.0 / OpenID Connect:** federación de identidades
-   **Rate limiting:** prevenir abuso de APIs
-   **CORS:** controlar acceso cross-origin

---

## 🌍 Infraestructura Cloud vs On-Premise

### **Cloud Providers**

| Proveedor    | Compute                     | Database                | Storage       | CDN        |
| ------------ | --------------------------- | ----------------------- | ------------- | ---------- |
| AWS          | EC2, Lambda                 | RDS, DynamoDB           | S3, EBS       | CloudFront |
| Google Cloud | Compute Engine, Cloud Run   | Cloud SQL, Firestore    | Cloud Storage | Cloud CDN  |
| Azure        | Virtual Machines, Functions | SQL Database, Cosmos DB | Blob Storage  | Azure CDN  |

### **Ventajas Cloud**

-   **Elasticidad:** auto-scaling automático
-   **Disponibilidad:** SLA 99.9%+
-   **Managed Services:** menos mantenimiento
-   **Global:** presencia mundial

### **On-Premise Benefits**

-   **Control total:** hardware y software
-   **Compliance:** regulaciones específicas
-   **Latencia:** acceso directo a datos
-   **Costos:** predictibles a largo plazo

---

## 🔧 Herramientas de Monitoreo

### **Observabilidad Stack**

-   **Logs:** ELK (Elasticsearch, Logstash, Kibana)
-   **Metrics:** Prometheus + Grafana
-   **Tracing:** Jaeger, Zipkin
-   **APM:** New Relic, DataDog, AppDynamics

### **Health Checks**

-   **Liveness:** ¿está el proceso funcionando?
-   **Readiness:** ¿puede manejar tráfico?
-   **Startup:** ¿completó la inicialización?

---

## 📊 Patrones de Deployment

### **Blue-Green Deployment**

Production Traffic → Blue Environment
→ Green Environment (nuevas versiones)

### **Rolling Updates**

[V1, V1, V1] → [V2, V1, V1] → [V2, V2, V1] → [V2, V2, V2]

### **Canary Releases**

95% traffic → Stable version
5% traffic → Canary version (testing)

---

## 🎯 Próximos Pasos de Aprendizaje

1. **Práctica local:** Docker containers
2. **Cloud básico:** Deploy en AWS/GCP free tier
3. **Containerización:** Docker + Kubernetes
4. **CI/CD:** GitHub Actions, Jenkins
5. **Monitoring:** Implementar observabilidad completa

---

_Esta guía cubre los fundamentos técnicos esenciales para entender servidores modernos. Úsala como referencia para proyectos y decisiones de arquitectura._
