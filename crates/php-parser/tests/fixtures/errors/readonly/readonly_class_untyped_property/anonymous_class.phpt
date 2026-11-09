===source===
<?php
$x = new readonly class { public $f; };
===errors <=8.2===
'readonly anonymous classes' requires PHP 8.3 or higher
Readonly property class@anonymous::$f must have type
===errors >=8.3===
Readonly property class@anonymous::$f must have type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Readonly property class@anonymous::$f must have type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
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
                                    "name": "f",
                                    "span": {
                                      "start": 39,
                                      "end": 41
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
                                "start": 32,
                                "end": 41
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 44
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 44
          }
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
