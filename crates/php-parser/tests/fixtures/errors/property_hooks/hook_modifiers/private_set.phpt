===source===
<?php
class A {
    public int $d { private(set) get => 1; }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Cannot use the private(set) modifier on a property hook
===errors >=8.4===
Cannot use the private(set) modifier on a property hook
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use the private(set) modifier on a property hook in Standard input code on line 3
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
                    "name": "d",
                    "span": {
                      "start": 31,
                      "end": 33
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
                          "start": 27,
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 30
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
                            "start": 56,
                            "end": 57
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 58
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
