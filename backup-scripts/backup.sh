#!/bin/bash

BACKUP_DIR="./backup"
DATE=$(date +%Y%m%d_%H%M%S)

# Crear directorio si no existe
mkdir -p "$BACKUP_DIR"

#función parea backup de archivos 
backup_files(){
    local source =$1
    local filename="backup_codigo_fuente_${DATE}.tar.gz"

    if tar -czf "${BACKUP_DIR}/${filename}" -C "$source" .; then
        echo "Backup de archivos creado exitosamente: ${BACKUP_DIR}/${filename}"
    else
        echo "Error al crear el backup de archivos"
    fi
}

