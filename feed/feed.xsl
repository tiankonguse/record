<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	version="2.0">
	<xsl:template match="/">
		<html>
			<head>
				<title>
					RSS-
					<xsl:value-of select="rss/channel/title" />
				</title>
				<link href="my_rss_style.css" rel="stylesheet" />
			</head>
			<body>
				<xsl:apply-templates select="rss/channel" />
				<script src="publib_footer.js" type="text/javascript"></script>
			</body>
		</html>
	</xsl:template>

	<xsl:template match="channel">
		<div class="header">
				<div class="title">
					<span style="font-size:24px; font-weight:bold;">
						<xsl:element name="A">
							<xsl:attribute name="href">
								<xsl:value-of select="link" />
             				</xsl:attribute>
							<xsl:attribute name="target"> _blank</xsl:attribute>
							<xsl:value-of select="title" />
						</xsl:element>
					</span>
					<span style="font-size:14px;padding-left:20px;">
						<xsl:value-of select="description" />
					</span>
				</div>

			</div>

		<div class="content">
			<div class="item">
				<xsl:for-each select="item">
					<div class="title">
						<xsl:element name="A">
							<xsl:attribute name="href">
                <xsl:value-of select="link" />
              </xsl:attribute>
							<xsl:attribute name="target">_blank</xsl:attribute>
							<xsl:value-of select="title" />
						</xsl:element>
					</div>
					<div class="description">
						<xsl:value-of select="description"
							disable-output-escaping="yes" />
					</div>
				</xsl:for-each>
			</div>
		</div>

	</xsl:template>
</xsl:stylesheet>