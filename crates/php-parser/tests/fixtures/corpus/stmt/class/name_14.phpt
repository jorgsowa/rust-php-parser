===source===
<?php interface A extends PARENT {}
===errors <=7.4===
Cannot use 'PARENT' as interface name as it is reserved
===errors 8.0-8.3===
Cannot use 'PARENT' as interface name, as it is reserved
===errors >=8.4===
Cannot use "PARENT" as interface name, as it is reserved
===php_error <=7.4===
PHP Fatal error:  Cannot use 'PARENT' as interface name as it is reserved in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Cannot use "PARENT" as interface name, as it is reserved in Standard input code on line 1
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
                "PARENT"
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
