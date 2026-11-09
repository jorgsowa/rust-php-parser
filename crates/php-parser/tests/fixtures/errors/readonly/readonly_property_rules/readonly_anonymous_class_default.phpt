===source===
<?php
$x = new readonly class { public int $m = 5; };
===errors <=8.2===
'readonly anonymous classes' requires PHP 8.3 or higher
Readonly property class@anonymous::$m cannot have default value
===errors 8.3-8.5===
Readonly property class@anonymous::$m cannot have default value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 2
===php_error 8.3-8.5===
PHP Fatal error:  Readonly property class@anonymous::$m cannot have default value in Standard input code on line 2
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
                                    "name": "m",
                                    "span": {
                                      "start": 43,
                                      "end": 45
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
                                          "start": 39,
                                          "end": 42
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 39,
                                      "end": 42
                                    }
                                  },
                                  "default": {
                                    "kind": {
                                      "Int": 5
                                    },
                                    "span": {
                                      "start": 48,
                                      "end": 49
                                    }
                                  },
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 32,
                                "end": 49
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 52
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 52
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 52
          }
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
