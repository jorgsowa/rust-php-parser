===source===
<?php
function tmpl() {
    foo();
    ?>
<div>
<?php // comment ?>
    <p>text</p>
<?php
    bar();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "tmpl",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "foo"
                        },
                        "span": {
                          "start": 28,
                          "end": 31
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 33
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 39
              }
            },
            {
              "kind": {
                "InlineHtml": "\n<div>\n"
              },
              "span": {
                "start": 41,
                "end": 48
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 65,
                "end": 67
              }
            },
            {
              "kind": {
                "InlineHtml": "\n    <p>text</p>\n"
              },
              "span": {
                "start": 67,
                "end": 84
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 94,
                "end": 97
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "bar"
                        },
                        "span": {
                          "start": 94,
                          "end": 97
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 94,
                    "end": 99
                  }
                }
              },
              "span": {
                "start": 94,
                "end": 101
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
        "end": 102
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102
  }
}
