===source===
<?php
readonly class B {
    public static int $h;
}
===errors <=8.1===
'readonly class' requires PHP 8.2 or higher
Static property B::$h cannot be readonly
===errors >=8.2===
Static property B::$h cannot be readonly
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Static property B::$h cannot be readonly in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 47,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 43,
                          "end": 46
                        }
                      }
                    },
                    "span": {
                      "start": 43,
                      "end": 46
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 49
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
