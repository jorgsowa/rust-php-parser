===source===
<?php
class C { function &g() { yield from f(); } }
===errors===
Cannot use "yield from" inside a by-reference generator
===php_error <=8.1===
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
===php_error 8.2===
PHP Fatal error:  Cannot use "yield from" inside a by-reference generator in Standard input code on line 2
===php_error >=8.3===
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
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "by_ref": true,
                  "params": [],
                  "return_type": null,
                  "body": [
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
                                            "start": 43,
                                            "end": 44
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 43,
                                        "end": 44
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 43,
                                  "end": 46
                                }
                              },
                              "is_from": true
                            }
                          },
                          "span": {
                            "start": 32,
                            "end": 46
                          }
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 47
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 49
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
