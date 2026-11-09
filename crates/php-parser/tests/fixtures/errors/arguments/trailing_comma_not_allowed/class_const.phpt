===source===
<?php
class C {
    const Y = 1,;
}
===errors===
expected constant name, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 33
              }
            }
          ],
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
