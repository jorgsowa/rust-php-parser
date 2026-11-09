===source===
<?php
class A {
    var final $c;
}
===errors <=8.3===
expected variable, found 'final'
'final properties' requires PHP 8.4 or higher
===errors >=8.4===
expected variable, found 'final'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'final' (T_FINAL), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "final", expecting variable in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 30,
                      "end": 32
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true,
                    "is_var": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 32
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
