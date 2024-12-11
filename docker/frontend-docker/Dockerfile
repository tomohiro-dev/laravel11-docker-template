FROM node:22-alpine as node
RUN apk add --no-cache curl
WORKDIR /workspace/frontend
COPY ./frontend/package*.json ./  
# hostのfrontend/package*.jsonをコピーする
RUN npm install
COPY ./frontend ./
# hostのfrontend dir全体をコピーする
EXPOSE 30000
CMD ["npm", "run", "dev"]