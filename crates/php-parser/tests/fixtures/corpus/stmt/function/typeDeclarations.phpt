===source===
<?php

function a($b, array $c, callable $d, E $f) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "a",
          "params": [
            {
              "name": "b",
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
                "end": 20,
                "start_line": 3,
                "start_col": 11
              }
            },
            {
              "name": "c",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 22,
                      "end": 27,
                      "start_line": 3,
                      "start_col": 15
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 27,
                  "start_line": 3,
                  "start_col": 15
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
                "end": 30,
                "start_line": 3,
                "start_col": 15
              }
            },
            {
              "name": "d",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "callable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 32,
                      "end": 40,
                      "start_line": 3,
                      "start_col": 25
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 40,
                  "start_line": 3,
                  "start_col": 25
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
                "end": 43,
                "start_line": 3,
                "start_col": 25
              }
            },
            {
              "name": "f",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "E"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 45,
                      "end": 47,
                      "start_line": 3,
                      "start_col": 38
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 47,
                  "start_line": 3,
                  "start_col": 38
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
                "end": 49,
                "start_line": 3,
                "start_col": 38
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
        "end": 53,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
