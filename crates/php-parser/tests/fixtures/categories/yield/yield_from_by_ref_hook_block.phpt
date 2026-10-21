===source===
<?php
class C { public $p { &get { yield from f(); } } }
===errors===
Cannot use "yield from" inside a by-reference generator
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.2===
Cannot load Xdebug - it was already loaded
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "p",
                    "span": {
                      "start": 23,
                      "end": 25
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
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Yield": {
                                    "key": null,
                                    "value": {
                                      "kind": {
                                        "FunctionCall": {
                                          "name": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "f"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 46,
                                                  "end": 47
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 46,
                                              "end": 47
                                            }
                                          },
                                          "args": []
                                        }
                                      },
                                      "span": {
                                        "start": 46,
                                        "end": 49
                                      }
                                    },
                                    "is_from": true
                                  }
                                },
                                "span": {
                                  "start": 35,
                                  "end": 49
                                }
                              }
                            },
                            "span": {
                              "start": 35,
                              "end": 50
                            }
                          }
                        ]
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 28,
                        "end": 52
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 54
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
