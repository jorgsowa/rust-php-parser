===source===
<?php
class A {
    public $b { SET($x, $y) {} }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
set hook of property A::$b must accept exactly one parameters
===errors >=8.4===
set hook of property A::$b must accept exactly one parameters
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  SET hook of property A::$b must accept exactly one parameters in Standard input code on line 3
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
                    "name": "b",
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
                            "name": "x",
                            "span": {
                              "start": 36,
                              "end": 38
                            }
                          },
                          "type_hint": null,
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 36,
                            "end": 38
                          }
                        },
                        {
                          "name": {
                            "name": "y",
                            "span": {
                              "start": 40,
                              "end": 42
                            }
                          },
                          "type_hint": null,
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 40,
                            "end": 42
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 46
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
