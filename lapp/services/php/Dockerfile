FROM php:7.2-fpm
#  设置时区
ADD ./source.list  /etc/apt/
ENV TZ=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

#  更新安装依赖包和PHP核心拓展
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpq-dev \
        libpng-dev \
		libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install -j$(nproc) gd \
        && docker-php-ext-install zip \
        && docker-php-ext-install opcache \
        && docker-php-ext-install pdo pdo_pgsql \
        && rm -r /var/lib/apt/lists/*


#  将预先下载好的拓展包从宿主机拷贝进去
#COPY ./pkg/redis.tgz /home/redis.tgz
#COPY ./pkg/cphalcon.tar.gz /home/cphalcon.tar.gz

#  安装 PECL 拓展，这里我们安装的是Redis
#RUN pecl install /home/redis.tgz && echo "extension=redis.so" > /usr/local/etc/php/conf.d/redis.ini

#  安装第三方拓展，这里是 Phalcon 拓展
#RUN cd /home \
#    && tar -zxvf cphalcon.tar.gz \
#    && mv cphalcon-* phalcon \
#    && cd phalcon/build \
#    && ./install \
#    && echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/phalcon.ini

ENV COMPOSER_HOME /root/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH $COMPOSER_HOME/vendor/bin:$PATH

WORKDIR /data
RUN usermod -u 1000 www-data

