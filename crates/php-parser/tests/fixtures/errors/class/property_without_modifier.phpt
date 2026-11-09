===source===
<?php
class A { $val; }
===errors===
expected 'function' or 'const', found variable
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '$val' (T_VARIABLE), expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected variable "$val", expecting "function" or "const" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected variable "$val", expecting "function" in Standard input code on line 2
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
                    "name": "val",
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 20
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
