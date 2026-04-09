===source===
#!/usr/bin/env php
<?php

echo "foobar";

?>
#!/usr/bin/env php
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "foobar"
            },
            "span": {
              "start": 31,
              "end": 39,
              "start_line": 4,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 26,
        "end": 42,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "InlineHtml": "\n#!/usr/bin/env php"
      },
      "span": {
        "start": 44,
        "end": 63,
        "start_line": 6,
        "start_col": 2
      }
    }
  ],
  "span": {
    "start": 19,
    "end": 63,
    "start_line": 2,
    "start_col": 0
  }
}
