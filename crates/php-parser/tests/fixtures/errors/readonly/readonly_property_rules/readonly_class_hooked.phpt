===source===
<?php
readonly class B {
    public int $i { get => 1; }
}
===errors <=8.1===
'readonly class' requires PHP 8.2 or higher
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors 8.2-8.3===
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors >=8.4===
Hooked properties cannot be readonly
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===php_error 8.2-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Hooked properties cannot be readonly in Standard input code on line 3
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
                    "name": "i",
                    "span": {
                      "start": 40,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 39
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 52,
                            "end": 53
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 45,
                        "end": 54
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 29,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
