===source===
<?php
class A {
    public function __construct(private $x { final set {} }) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
Property hook cannot be both final and private
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
Property hook cannot be both final and private
===errors >=8.4===
Property hook cannot be both final and private
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'private' (T_PRIVATE), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Property hook cannot be both final and private in Standard input code on line 3
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
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 56,
                          "end": 58
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Set",
                          "body": {
                            "Block": []
                          },
                          "modifiers": {
                            "is_final": true
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 61,
                            "end": 73
                          }
                        }
                      ],
                      "span": {
                        "start": 48,
                        "end": 75
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 79
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 81
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 81
  }
}
