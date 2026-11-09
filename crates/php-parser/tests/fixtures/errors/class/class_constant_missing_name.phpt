===source===
<?php
class A {
    const = 1;
}
===errors===
expected constant name, found '='
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "=" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 28,
                      "end": 29
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 30
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
