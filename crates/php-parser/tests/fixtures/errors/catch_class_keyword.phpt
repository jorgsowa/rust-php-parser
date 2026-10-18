===source===
<?php
try {
} catch (self $e) {
} catch (A | Parent $e) {
} catch (static) {
} catch (\self $e) {
}
===errors===
Bad class name in the catch statement
Bad class name in the catch statement
Bad class name in the catch statement
'\self' is an invalid class name
===php_error===
PHP Fatal error:  Bad class name in the catch statement in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "self"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 21,
                    "end": 25
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 26,
                  "end": 28
                }
              },
              "body": [],
              "span": {
                "start": 20,
                "end": 33
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "A"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 41,
                    "end": 42
                  }
                },
                {
                  "parts": [
                    "Parent"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 45,
                    "end": 51
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 52,
                  "end": 54
                }
              },
              "body": [],
              "span": {
                "start": 40,
                "end": 59
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "static"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 67,
                    "end": 73
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 66,
                "end": 78
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "self"
                  ],
                  "kind": "FullyQualified",
                  "span": {
                    "start": 86,
                    "end": 91
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 92,
                  "end": 94
                }
              },
              "body": [],
              "span": {
                "start": 85,
                "end": 99
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 99
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99
  }
}
