===source===
<?php use A\B\{};
===errors===
expected at least one import in group use, found '}'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": []
        }
      },
      "span": {
        "start": 6,
        "end": 17,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17,
    "start_line": 1,
    "start_col": 0
  }
}
