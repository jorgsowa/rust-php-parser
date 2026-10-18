===source===
<?php
#[Attr(...$x)]
function f() {}
#[Attr(1, ...[2])]
class C {}
===errors===
Cannot use unpacking in attribute argument list
Cannot use unpacking in attribute argument list
===php_error===
PHP Fatal error:  Cannot use unpacking in attribute argument list in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 30,
              "end": 31
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 12
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 16,
                      "end": 18
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 13,
                    "end": 18
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 21,
        "end": 36
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 62,
              "end": 63
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 39,
                  "end": 43
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 44,
                      "end": 45
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 44,
                    "end": 45
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 51,
                              "end": 52
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 51,
                            "end": 52
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 50,
                      "end": 53
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 47,
                    "end": 53
                  }
                }
              ],
              "span": {
                "start": 39,
                "end": 54
              }
            }
          ]
        }
      },
      "span": {
        "start": 56,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
