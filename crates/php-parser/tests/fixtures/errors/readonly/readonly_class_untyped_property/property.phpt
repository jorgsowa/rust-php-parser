===source===
<?php
readonly class C {
    public $a;
}
===errors <=8.1===
'readonly class' requires PHP 8.2 or higher
Readonly property C::$a must have type
===errors >=8.2===
Readonly property C::$a must have type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Readonly property C::$a must have type in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "a",
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 38
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
