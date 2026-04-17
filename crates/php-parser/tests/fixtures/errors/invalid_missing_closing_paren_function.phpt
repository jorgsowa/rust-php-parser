===config===
min_php=8.4
===source===
<?php
function foo(int $a, $b {
    return $a + $b;
}
===errors===
unclosed '')'' opened at Span { start: 18, end: 19 }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "a",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 19,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 22
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
                "start": 19,
                "end": 25
              }
            },
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
                "start": 27,
                "end": 29
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 43,
                          "end": 45
                        }
                      },
                      "op": "Add",
                      "right": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 48,
                          "end": 50
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 43,
                    "end": 50
                  }
                }
              },
              "span": {
                "start": 36,
                "end": 51
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
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
===php_error===
PHP Parse error:  syntax error, unexpected token "return", expecting identifier in Standard input code on line 3
