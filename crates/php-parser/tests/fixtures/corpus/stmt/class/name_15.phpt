===source===
<?php interface A extends static {}
===errors===
Cannot use "static" as interface name, as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting identifier (T_STRING) or namespace (T_NAMESPACE) or \\ (T_NS_SEPARATOR) in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Cannot use "static" as interface name, as it is reserved in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "A",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [
            {
              "parts": [
                "static"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 26,
                "end": 32
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
