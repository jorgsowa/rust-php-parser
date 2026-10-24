===source===
<?php
class A {
    public $x { set($value = 1) {} }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Parameter $value of set hook A::$x must not have a default value
===errors >=8.4===
Parameter $value of set hook A::$x must not have a default value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Parameter $value of set hook A::$x must not have a default value in Standard input code on line 3
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
                    "name": "x",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "value",
                            "span": {
                              "start": 36,
                              "end": 42
                            }
                          },
                          "type_hint": null,
                          "default": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 45,
                              "end": 46
                            }
                          },
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 36,
                            "end": 46
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 50
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
