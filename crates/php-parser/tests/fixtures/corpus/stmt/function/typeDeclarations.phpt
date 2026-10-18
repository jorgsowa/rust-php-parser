===source===
<?php

function a($b, array $c, callable $d, E $f) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "params": [
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 18,
                  "end": 20
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 18,
                "end": 20
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 28,
                  "end": 30
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 22,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 27
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 22,
                "end": 30
              }
            },
            {
              "name": {
                "name": "d",
                "span": {
                  "start": 41,
                  "end": 43
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "callable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 32,
                      "end": 40
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 40
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 32,
                "end": 43
              }
            },
            {
              "name": {
                "name": "f",
                "span": {
                  "start": 47,
                  "end": 49
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "E"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 45,
                      "end": 46
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 46
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 45,
                "end": 49
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
        "start": 7,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
