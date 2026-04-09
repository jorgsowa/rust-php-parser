===source===
<?php
function test1($a, ... $b) {}
function test2($a, &... $b) {}
function test3($a, Type ... $b) {}
function test4($a, Type &... $b) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test1",
          "params": [
            {
              "name": "a",
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
                "start": 21,
                "end": 23,
                "start_line": 2,
                "start_col": 15
              }
            },
            {
              "name": "b",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 25,
                "end": 31,
                "start_line": 2,
                "start_col": 19
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
        "start": 6,
        "end": 35,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test2",
          "params": [
            {
              "name": "a",
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
                "start": 51,
                "end": 53,
                "start_line": 3,
                "start_col": 15
              }
            },
            {
              "name": "b",
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 55,
                "end": 62,
                "start_line": 3,
                "start_col": 19
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
        "start": 36,
        "end": 66,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test3",
          "params": [
            {
              "name": "a",
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
                "start": 82,
                "end": 84,
                "start_line": 4,
                "start_col": 15
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 86,
                      "end": 91,
                      "start_line": 4,
                      "start_col": 19
                    }
                  }
                },
                "span": {
                  "start": 86,
                  "end": 91,
                  "start_line": 4,
                  "start_col": 19
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 86,
                "end": 97,
                "start_line": 4,
                "start_col": 19
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
        "start": 67,
        "end": 101,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test4",
          "params": [
            {
              "name": "a",
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
                "start": 117,
                "end": 119,
                "start_line": 5,
                "start_col": 15
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 121,
                      "end": 126,
                      "start_line": 5,
                      "start_col": 19
                    }
                  }
                },
                "span": {
                  "start": 121,
                  "end": 126,
                  "start_line": 5,
                  "start_col": 19
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 121,
                "end": 133,
                "start_line": 5,
                "start_col": 19
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
        "start": 102,
        "end": 137,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 137,
    "start_line": 1,
    "start_col": 0
  }
}
