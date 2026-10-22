===source===
<?php
class A { function f() {} $x; }
===errors===
expected 'function' or 'const', found variable
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '$x' (T_VARIABLE), expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected variable "$x", expecting "function" or "const" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected variable "$x", expecting "function" in Standard input code on line 2
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
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 25,
                      "end": 26
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 31
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 32,
                      "end": 34
                    }
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 32,
                "end": 34
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
