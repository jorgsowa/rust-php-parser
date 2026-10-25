===source===
<?php
namespace A;
function Assert($x) {}
if (true) {
    function assert() {}
}
class B {
    function assert() {}
}
===errors >=8.0===
Defining a custom assert() function is not allowed, as the function has special semantics
Defining a custom assert() function is not allowed, as the function has special semantics
===php_error >=8.0===
PHP Fatal error:  Defining a custom assert() function is not allowed, as the function has special semantics in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "Assert",
            "span": {
              "start": 28,
              "end": 34
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 35,
                "end": 37
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 41
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 46,
              "end": 50
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Function": {
                      "name": {
                        "name": "assert",
                        "span": {
                          "start": 67,
                          "end": 73
                        }
                      },
                      "params": [],
                      "body": [],
                      "return_type": null,
                      "by_ref": false,
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 58,
                    "end": 78
                  }
                }
              ]
            },
            "span": {
              "start": 52,
              "end": 80
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 42,
        "end": 80
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 87,
              "end": 88
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
                    "name": "assert",
                    "span": {
                      "start": 104,
                      "end": 110
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 95,
                "end": 115
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 81,
        "end": 117
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 117
  }
}
