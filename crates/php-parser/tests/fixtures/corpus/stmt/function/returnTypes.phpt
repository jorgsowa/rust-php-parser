===source===
<?php

function test1() {}
function test2() : array {}
function test3() : callable {}
function test4() : Foo\Bar {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test1",
            "span": {
              "start": 16,
              "end": 21
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
        "start": 7,
        "end": 26
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test2",
            "span": {
              "start": 36,
              "end": 41
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "array"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 46,
                  "end": 51
                }
              }
            },
            "span": {
              "start": 46,
              "end": 51
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 27,
        "end": 54
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test3",
            "span": {
              "start": 64,
              "end": 69
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "callable"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 74,
                  "end": 82
                }
              }
            },
            "span": {
              "start": 74,
              "end": 82
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 55,
        "end": 85
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test4",
            "span": {
              "start": 95,
              "end": 100
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 105,
                  "end": 112
                }
              }
            },
            "span": {
              "start": 105,
              "end": 112
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 86,
        "end": 115
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 115
  }
}
