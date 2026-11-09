===source===
<?php
readonly class C {
    public function __construct(public $c) {}
}
===errors <=7.4===
'readonly class' requires PHP 8.2 or higher
'constructor property promotion' requires PHP 8.0 or higher
Readonly property C::$c must have type
===errors 8.0-8.1===
'readonly class' requires PHP 8.2 or higher
Readonly property C::$c must have type
===errors >=8.2===
Readonly property C::$c must have type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Readonly property C::$c must have type in Standard input code on line 3
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 45,
                      "end": 56
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "c",
                        "span": {
                          "start": 64,
                          "end": 66
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 57,
                        "end": 66
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 70
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
